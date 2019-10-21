# Introduction
This extension is base on the [mediatis/formrelay](https://github.com/mediatis/formrelay) package and you and use it to get the data of any TYPO3/form (or other form extensions that are supported by formrelay) to Pardot. We use Pardot Formhandlers, so all your reactions you defined in Pardot will be made.

You should checkout  https://github.com/mediatis/formrelay to find more detail how use the plugin.

# Support
If you have any question, please contact us voehringer@mediatis.de

# Setup

All basic settings, explained in EXT:formrelay, (including the overwrite mechanics) apply to this extension as well.  

## plugin.tx_formrelay_pardot.settings.enabled

Default: `0`.

Set to `1` to enable the extension.

## plugin.tx_formrelay_pardot.settings.pardotUrl

Default: empty

Set the URL of the Pardot Formhandler.

## plugin.tx_formrelay_pardot.settings.fields.mapping

There is a default mapping for standard Pardot fields set.
