# Froala WYSIWYG Editor Plugin for CakePHP

[![Build Status](https://travis-ci.org/froala/wysiwyg-cake2.svg)](https://travis-ci.org/froala/wysiwy-cake2)
[![Packagist](https://img.shields.io/packagist/v/froala/wysiwyg-cake2.svg)](https://packagist.org/packages/froala/wysiwyg-cake2)
[![Packagist](https://img.shields.io/packagist/dt/froala/wysiwyg-cake2.svg)](https://packagist.org/packages/froala/wysiwyg-cake2)

>CakePHP Plugin for Froala Javascript WYSIWYG Text Editor. For cake 2.3+

## About
The purpose of placing [Froala WYSIWYG Editor](http://editor.froala.com) in a plugin is to keep it separate from a themed view, the regular webroot or the app in general, which makes it easier to update and overall follows the idea of keeping the code clean and modular.

## Installation
To use Froala WYSIWYG Editor you need to clone git repository:

	git clone git://github.com/froala/wysiwyg-cake2.git Plugin/Froala

Or if your CakePHP application is setup as a git repository, you can add it as a submodule:

	git submodule add git://github.com/froala/wysiwyg-cake2.git Plugin/Froala

Alternatively, you can download an archive from the [master branch on Github](https://github.com/froala/wysiwyg-cake/archive/master.zip) and extract the contents to `Plugin/Froala`.

 Add:

         "froala/wysiwyg-cake2": "^2.9"

to the require section of your composer.json file.

or use [composer](https://getcomposer.org/download/) :

    php ./composer.phar require froala/wysiwyg-cake2

Then move the FroalaEditor folder from /Plugins to app/Plugin and rename it to Froala,or directly clone the folder from git repository to app/Plugin. 

## Usage
The Froala helper is basically just a convenience helper that allows you to use php and CakePHP conventions to generate the configuration for Froala and as an extra it allows you to load configs.

There two ways you can use this plugin, simply use the helper or load the editor "by hand" using

```php
$this->Html->css('/Froala/css/froala_editor.min.css');
$this->Html->script('/Froala/js/froala_editor.min.js', array('toolbarInline' => false));
```

and placing your own script in the head of the page. Please note that the helper will auto add the Froala editor script to the header of the page. No need to to that by hand if you use the helper.

If your app is not set up to work in the top level of your host / but instead in /yourapp/ the automatic inclusion of the script wont work. You'll manually have to add the js file to your app:

```php
$this->Html->css('/yourapp/Froala/css/froala_editor.min.css');
$this->Html->script('/yourapp/Froala/js/froala_editor.min.js', array('toolbarInline' => false));
```

If you need to load the plugins, then use:

```php
$this->Html->script(
  array(
    '/Froala/js/froala_editor.min.js',
    '/Froala/js/plugins/align.min.js',
    '/Froala/js/plugins/char_counter.min.js',
    '/Froala/js/plugins/code_beautifier.min.js',
    '/Froala/js/plugins/code_view.min.js',
    '/Froala/js/plugins/colors.min.js',
    '/Froala/js/plugins/draggable.min.js',
    '/Froala/js/plugins/emoticons.min.js',
    '/Froala/js/plugins/entities.min.js',
    '/Froala/js/plugins/file.min.js',
    '/Froala/js/plugins/font_family.min.js',
    '/Froala/js/plugins/font_size.min.js',
    '/Froala/js/plugins/fullscreen.min.js',
    '/Froala/js/plugins/help.min.js',
	'/Froala/js/plugins/image.min.js',
    '/Froala/js/plugins/image_manager.min.js',
    '/Froala/js/plugins/inline_style.min.js',
    '/Froala/js/plugins/line_breaker.min.js',
    '/Froala/js/plugins/link.min.js',
    '/Froala/js/plugins/lists.min.js',
    '/Froala/js/plugins/paragraph_format.min.js',
    '/Froala/js/plugins/paragraph_style.min.js',
    '/Froala/js/plugins/print.min.js',
    '/Froala/js/plugins/quick_insert.min.js',
    '/Froala/js/plugins/quote.min.js',
    '/Froala/js/plugins/save.min.js',
    '/Froala/js/plugins/special_characters.min.js',
    '/Froala/js/plugins/table.min.js',
    '/Froala/js/plugins/url.min.js',
    '/Froala/js/plugins/video.min.js'),

  array('toolbarInline' => false)
);


$this->Html->css(
  array(
    '/Froala/css/froala_editor.min.css',
    '/Froala/css/froala_style.min.css',
    '/Froala/css/plugins/char_counter.min.css',
    '/Froala/css/plugins/code_view.min.css',
    '/Froala/css/plugins/colors.min.css',
    '/Froala/css/plugins/draggable.min.css',
    '/Froala/css/plugins/emoticons.min.css',
    '/Froala/css/plugins/file.min.css',
    '/Froala/css/plugins/fullscreen.min.css',
    '/Froala/css/plugins/help.min.css',
    '/Froala/css/plugins/image_manager.min.css',
    '/Froala/css/plugins/image.min.css',
    '/Froala/css/plugins/line_breaker.min.css',
    '/Froala/css/plugins/quick_insert.min.css',
    '/Froala/css/plugins/special_characters.min.css',
    '/Froala/css/plugins/table.min.css',
    '/Froala/css/plugins/video.min.css'
  )
);
```

## How to use the helper

Since CakePHP 2.0 it is necessary to activate the plugin in your application. To do so,
edit `app/Config/bootstrap.php` and add the line `CakePlugin::load('Froala');` at the
bottom. If you already have `CakePlugin::loadAll();` to auto-load all plugins then you may skip this step.

Wherever you want to use it, load it in the controller

```php

class AppController extends Controller
{
	...
	
	public $helpers = array('Froala.Froala');
	
	...
}
```

In the view simply use the editor() method and pass options as key/value pairs in an array.


```php
<div class="selector">
  <?= $this->Froala->editor('.selector');?>
</div>
```

This will instruct Froala to convert all matched elements on the page to Froala editors. If you require some more precise control, or want to change this behavior, checkout the [Froala configuration options](http://editor.froala.com/docs/options) on the Froala website.


## Default options

If you want a quick way to configure default values for all the Froala Editors of an application, you could use the 'Froala.editorOptions' configuration.

Here is an example of a line you could have in `bootstrap.php`:

```php
Configure::write('Froala.editorOptions', array('height' => '300px'))
```

It will make all editors to have a 300px height. You may want to override this value for a single editor. To do so, just pass the option to the editor() method and it will override the default value.

You can also pass options at editor iniliatization as given below 
```
$this->Froala->editor('.selector', array('option' => value));
```

You can always check the tests to see how to use the helper.

## Requirements

* PHP version: PHP 5.2+
* CakePHP version: CakePHP 2.1+

## License

The `wysiwyg-cake` project is under MIT license. However, in order to use Froala WYSIWYG HTML Editor plugin you should purchase a license for it.

Froala Editor has [3 different licenses](http://editor.froala.com/download/) for commercial use.
For details please see [License Agreement](http://editor.froala.com/license).
