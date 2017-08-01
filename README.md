# October CMS Twig thumbnail filter
A simple plugin for making thumbnails with a Twig filter.   
This plugin makes use of the `getThumb($width, $height, $options)` function as described in the File attachments documentation [here](https://octobercms.com/docs/database/attachments#viewing-attachments)

## Usage
The filter must be used on a path relative to the main application directory    
```
'path'|thumbnail(width, height, options)
```

**width** and **height** should be specified as number or **auto** for the automatic proportional scaling (defaults to *auto*).

### Options
Option|Value
------------ | -------------
**mode**|auto, exact, portrait, landscape, crop. Default: auto
**quality**|0 - 100. Default: 95
**interlace**|boolean: false (default), true
**extension**|auto, jpg, png, gif. Default: jpg
**debug**|boolean: false (default), true *(If an error occurs, a PHP exception will be thrown)*


### Some examples

```html
<!-- Makes the image 500 pixels wide and scales height automatically -->
<img src="{{ 'storage/app/media/image.png'|thumbnail(500, 'auto') }}">

<!-- You can also use the built in twig path filters -->
<img src="{{ 'image.png'|media|thumbnail(500, 'auto') }}">
<img src="{{ 'assets/img/image.png'|theme|thumbnail(500, 'auto') }}">

<!-- You can pass options like so  -->
<img src="{{ 'image.png'|media|thumbnail(50, 50, {'mode': 'crop'}) }}">
```
