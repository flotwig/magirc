{* $Id$ *}
{include file="_header.tpl"}

<div class="page_title">Database Settings</div>
<form id="sql" name="sql" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td align="right">Username</td>
      <td align="left"><input name="username" type="text" id="username" tabindex="1" value="{$db.username}" size="32" maxlength="1024" /></td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td align="left"><input type="password" name="password" id="password" tabindex="2" value="{$db.password}" size="32" maxlength="1024" /></td>
    </tr>
    <tr>
      <td align="right">Database Name</td>
      <td align="left"><input type="text" name="database" id="database" tabindex="3" value="{$db.database}" size="32" maxlength="1024" /></td>
    </tr>
    <tr>
      <td align="right">Hostname</td>
      <td align="left"><input type="text" name="hostname" id="hostname" tabindex="4" value="{$db.hostname}" size="32" maxlength="1024" /></td>
    </tr>
    <tr>
      <td align="right">TCP Port</td>
      <td align="left"><input type="text" name="port" id="port" tabindex="5" value="{$db.port}" size="32" maxlength="1024" /></td>
    </tr>
  </table>
  <pre>The configuration file <em>{$db_config_file}</em> is {if $writable}<span style="color:green;">writable</span>
  {else}<span style="color:red;">not writable</span><br />Please ensure that it has enough write permissions. Try chmod 0666 or 0777.
  {if $smarty.post.button}
  <br />Alternatively, please copy the following text<br />and paste it into the {$db_config_file} file:<br />
  <textarea name="sql_buffer" cols="64" rows="10" readonly="readonly">{$db_buffer}</textarea>
  {/if}
  {/if}
  </pre>
  <p align="right"><input type="submit" name="button" id="button" value="Save" tabindex="7" /></p>
</form>

{include file="_footer.tpl"}