
<div class="alert alert-danger">
  WARNING: This is a really dangerous form!  It will delete ALL your data from your database.
<br />
  DO NOT PRESS SUBMIT UNLESS YOU REALLY KNOW WHAT YOU ARE DOING.
</div>
<div class="help">
  <ul>
    <li>Enter a list of contact IDs you want to keep in "contact_ids" - this autoselects all contacts with a CMS user account by default</li>
    <li>Uncheck any tables that you do NOT want to clear the data from - this list should not include any config tables but may do for extensions etc. - so check!</li>
    <li>If logging is enabled the log tables will be cleared on submit and all caches cleared</li>
  </ul>
</div>

{foreach from=$elementNames item=elementName}
  <div class="crm-section">
    <div class="label">{$form.$elementName.label}</div>
    <div class="content">{$form.$elementName.html}</div>
    <div class="clear"></div>
  </div>
{/foreach}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
