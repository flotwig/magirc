<?php


// database configuration
class Magirc_DB extends DB {
	function Magirc_DB() {
		if (file_exists('../conf/magirc.cfg.php')) {
			include('../conf/magirc.cfg.php');
		} else {
			die ('magirc.cfg.php configuration file missing');
		}
		$dsn = "mysql:dbname={$db['database']};host={$db['hostname']}";
		$this->connect($dsn, $db['username'], $db['password']) || die('Error opening Magirc database<br />'.$this->error);
	}
}

class Admin {
	public $tpl;
	public $db;
	public $cfg;

	function __construct() {
		$this->tpl = new Smarty();
		$this->tpl->template_dir = 'tpl';
		$this->tpl->compile_dir = 'tmp';
		$this->tpl->config_dir = '../conf';
		$this->tpl->cache_dir = 'tmp';
		$this->tpl->error_reporting = E_ALL & ~E_NOTICE;
		$this->db = new Magirc_DB();
		$this->cfg = new Config();
		$this->ckeditor = new CKEditor();
		$this->ckeditor->basePath = '../js/ckeditor/';
		$this->ckeditor->returnOutput = true;
		$this->ckeditor->config['height'] = 300;
		$this->ckeditor->config['width'] = 740;
		$this->ckeditor->config['baseHref'] = '../';
		$this->ckeditor->config['contentsCss'] = array('theme/'.$this->cfg->getParam('theme').'/css/styles.css', 'theme/'.$this->cfg->getParam('theme').'/css/editor.css');
		$this->ckeditor->config['docType'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
		$this->ckeditor->config['emailProtection'] = 'encode';
		$this->ckeditor->config['entities'] = true;
		$this->ckeditor->config['forcePasteAsPlainText'] = true;
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['resizeEnabled'] = true;
		$this->ckeditor->config['toolbar'] = array(
			array('Maximize','ShowBlocks','Preview','Templates'),
			array('Cut','Copy','PasteText','-','Print','Scayt'),
			array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
			#array('Source'),
			array('Link','Unlink','Anchor'),
			array('Image','Table','HorizontalRule','Smiley','SpecialChar'),
	            '/',
			array('Format','FontSize','TextColor','BGColor'),
			array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
			array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
			array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock')
		);
		#CKFinder::SetupCKEditor($this->ckeditor, '../js/ckfinder/');
	}

	// login function
	function login($username, $password) {
		if (!isset($username) || !isset($password))
		return false;

		return $this->db->selectOne('magirc_admin', array('username' => $username, 'password' => md5(trim($password))));
	}

	// Returns session status
	function sessionStatus() {
		if (!isset($_SESSION["username"])) {
			$_SESSION["message"] = "Access denied";
			return false;
		}
		if (!isset($_SESSION["ip"]) || ($_SESSION["ip"] != $_SERVER["REMOTE_ADDR"])) {
			$_SESSION["message"] = "Access denied";
			return false;
		}
		return true;
	}

	/* Saves the given configuration parameter and value */
	function saveConfig($parameter, $value) {
		$this->cfg->config[$parameter] = $value;
		return $this->db->update('magirc_config', array('value' => $value), array('parameter' => $parameter));
	}
}

?>