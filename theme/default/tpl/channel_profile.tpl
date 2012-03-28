{extends file="_main.tpl"}

{block name="title" append}Channel: {$target}{/block}

{block name="content"}
<div id="tabs">
	<ul>
		<li><a href="index.php/channel/{$target|escape:'url'}/status">Status</a></li>
		<li><a href="index.php/channel/{$target|escape:'url'}/countries">Countries</a></li>
		<li><a href="index.php/channel/{$target|escape:'url'}/clients">Clients</a></li>
		<li><a href="index.php/channel/{$target|escape:'url'}/activity">Activity</a></li>
	</ul>
</div>
{/block}

{block name="js" append}
<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs({
		cache: true,
		spinner: 'Loading...',
		ajaxOptions: {
			error: function( xhr, status, index, anchor ) {
				$( anchor.hash ).html("Unable to load contents");
			}
		}
	});
});
</script>
{/block}