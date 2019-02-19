[![Build Status](https://travis-ci.org/siemendev/forskel.svg?branch=master)](https://travis-ci.org/siemendev/forskel)

# Forskel

Forskel is a fully decoupled frontend rendering library for multi-site symfony projects.

**Sound good, right? *But what does that MEAN?***

When using the same frontend for multiple symfony projects, one way to keep redundancy low is decoupling the full frontend architecture in an own bundle. Taking over from this approach I´ve been developing *Forksel* to keep the templating out of the operational symfony projects.

With *Forskel* you´re able to write super clean, object-oriented code instead of templating markup in the projects, while you  maintain the markup in the templates for all of them at one place in the *Forskel* based Extension Bundle.

## Give it a shot, take me to implementing *Forskel*!

First of all, one thing is important to understand: **You don´t implement *Forskel* in a normal project.**
*Forskel* is intended to be used as a basic library/tool for your own external frontend bundle.


### Setup your first *Forskel* bundle
So lets just jump right in and start with a basic implementation of *Forskel* for a demo project:

1. Setup an reusable Bundle for your project ouside your project root according to [The Symfony Documentation](https://symfony.com/doc/4.1/bundles/best_practices.html).
2. Install *Forskel* in your bundle: ``` $ composer require siemendev/forskel```
3. Install your reuseable bundle in one of your main projects by configuring a local [repository](https://getcomposer.org/doc/05-repositories.md) in your composer.json. As long as you are developing locally, you probably want to link the bundle via the [*path* repository type](https://getcomposer.org/doc/05-repositories.md#path). Later on production environments you probably use the vcs repository to install specific stable versions of your bundle to your project.
4. **Keep in mind:** Unless you still want to use it, the twig templating engine will from now on no longer be used in your project´s repository. All templates will be created and maintained inside of your newly created bundle.

**That´s it already, we´re good to go!**

### Implementing your first model

1. Create your model file. e.g. [bundle sources root]/models/MyFancyPage.php
  ```php
  namespace vendor\FrontendBundle\Models;
  
  use siemendev\ForskelBundle\Models\AbstractModel;
  use siemendev\ForskelBundle\Models\ModelInterface;

  class MyFancyPage extends AbstractModel
  {
      /** @var string */
      public $headline;
      
      /** @var ModelInterface[] */
      public $contents;
  }
  ```
  *Pro tip:* Using private properties here with properly type-sensitive getters and setters allows you to force the right type for your property!
  
2. Create the corresponding template in [bundle sources root]/Resources/views/my-fancy-page.html.twig
  ```html
  <html>
  <body>
      <p>This is my fancy page.</p>
      {% if model.headline is not empty %}
          <h1>{{ model.headline }}</h1>
      {% endif %}

      {% for content in model.contents %}
          {{ forskel_render(content) }}
      {% endfor %}
  </body>
  </html>
  ```
  
Okay, that´s it on the bundle side, lets move over to the project itself where you installed the bundle manually!


### Filling the model with data and rendering it
In this example we´re using an existing controller, the IndexController from any project that has our previously created reusable bundle installed (see Setup 3).

Usually you would end this controller with a ```return $this->render();``` statement rendering the view, let´s see how *Forskel* changes this:

```php
namespace vendor\ProjectBundle\Controller;

use vendor\FrontendBundle\Models\MyFancyPage;
use siemendev\ForskelBundle\Renderers\TwigRenderer;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(TwigRenderer $forskel)
    {
        $page = new MyFancyPage();
        $page->headline = 'This page is so fancy!';

        return $forskel->render($page));
    }
}
```
**Pro tip:** If you don't want to inject the Renderer in every controller manually, try extending symfonys AbstractController to automaticly load the renderer.

**Master tip:** Overwrite the render() method in the extended AbstractController. This way you remove the build-in twig rendering, which forces the developers in the project even more to use Forskel for Frontend rendering.

## Contribution welcome!
If you´re trying out *Forskel* and have some feedback, [open up an issue](https://github.com/siemendev/forskel/issues)
or start contributing directly into the github repository, I´m thankful for every help to make *Forskel* better!
