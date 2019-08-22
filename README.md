# Introduction

EXT:formrelay_mail is providing a destination for EXT:formrelay, which handles form submissions for various endpoints.

It is dispatching the form data as standardised email.

# Setup

All basic settings, explained in EXT:formrelay, (including the overwrite mechanics) apply to this extension as well.  

## plugin.tx_formrelay_mail.settings.enabled

Default: `0`.

Set to `1` to enable the extension.

## plugin.tx_formrelay_mail.settings.recipients

Default: `user@domain.com, user2@domain.com`.

Set the email addresses of the recipients as comma separated list.

## plugin.tx_formrelay_mail.settings.sender

Default: `website@domain.com`.

Set the email address of the sender.

## plugin.tx_formrelay_mail.settings.subject 

Default: `Mail from website`.

Set the subject of the email.

## plugin.tx_formrelay_mail.settings.includeAttachmentsInMail

Default: `0`.

Set to `1` if uploaded files shall be attached to the email.  
In any case the uploaded files will be linked within the email (as part of the form data).

## plugin.tx_formrelay_mail.settings.valueDelimiter

Default: `\s=\s`.

Set the separator between field name and value.  
`\s` will be translated to a space character.  
`\n` will be translated to a line break.

## plugin.tx_formrelay_mail.settings.lineDelimiter

Default: `\n`.

Set the separator between the different field-name-and-value-pairs.  
`\s` will be translated to a space character.  
`\n` will be translated to a line break.
