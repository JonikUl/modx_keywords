# keywords
MODX REVO Snippet for generating SEO keywords from Resource fields.

## PROPERTIES

**&id** Resource ID integer optional. Default: current

**&fields** string optional. A comma separated list of Resource fields. Default: 'pagetitle, longtitle, description'

**&tvs** string optional. A comma separated list of Resource TVs. Default: ''

**&min** integer optional. Minimum word length for including. Default: 4

**&limit** integer optional. Amount of words in a list. Default: 25

## USAGE

    [[!keywords?
        &fields=`content`
        &tvs=`myTV`
        &min=`5`
        &limit=`15`
    ]]

## OR WITH FENOM

    {'!keywords' | snippet: [
        'fields' => 'pagetitle, longtitle, content',
        'tvs' => 'test',
        'min' => 5,
        'limit' => 15,
    ]}

