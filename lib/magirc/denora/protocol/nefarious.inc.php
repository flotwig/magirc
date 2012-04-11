<?php
// Nefarious 13 protocol file for Denora support on Magirc

class Protocol {
	const ircd = 'nefarious';

	const oper_hidden_mode = 'H';
	const helper_mode = '';
	const bot_mode = 'B';
	const services_protection_mode = 'k';
	const chan_hide_mode = 'n';
	const chan_secret_mode = 's';
	const chan_private_mode = 'p';

	const chan_exception = true;
	const chan_invites = false;
	const line_sq = false;
	const line_g = false;
	const host_cloaking = true;
}

?>