<?php
namespace siemendev\ForskelBundle\Tests\Renderer;

use siemendev\ForskelBundle\Renderer\TwigRenderer;
use siemendev\ForskelBundle\Tests\ForskelTestCase;
use Symfony\Component\HttpFoundation\Response;

class TwigRendererTest extends ForskelTestCase
{
    public function testConstruct()
    {
        $renderer = new TwigRenderer($this->mockTwig());
        $this->assertInstanceOf(\Twig_Environment::class, $renderer->getTwig());
    }

    public function testRender()
    {
        $renderer = new TwigRenderer($this->mockTwig());
        $response = $renderer->render($this->mockModel());

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('somehtml', $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetTemplateByClassName()
    {
        $renderer = new TwigRenderer($this->mockTwig());

        $template = $renderer->getTemplateByClassName('siemendev\FrontendBundle\Models\MyModel', 'MyModel');
        $this->assertEquals('@Frontend/my-model.html.twig', $template);

        $template = $renderer->getTemplateByClassName('FrontendBundle\Models\MyModel', 'MyModel');
        $this->assertEquals('@Frontend/my-model.html.twig', $template);

        $template = $renderer->getTemplateByClassName('siemendev\FrontendBundle\Models\pages\MyModel', 'MyModel');
        $this->assertEquals('@Frontend/pages/my-model.html.twig', $template);

        $template = $renderer->getTemplateByClassName('null', 'MyModel');
        $this->assertEmpty($template);
    }

    /**
     * Mock the twig environment
     * @return \PHPUnit_Framework_MockObject_MockObject|\Twig_Environment
     */
    protected function mockTwig()
    {
        /** @var \Twig_Environment|\PHPUnit_Framework_MockObject_MockObject $twig */
        $twig = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $twig->method('render')
            ->willReturn('somehtml');

        $loader = $this->getMockBuilder(\Twig_LoaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $loader->method('exists')
            ->willReturn(true);

        $twig->method('getLoader')
            ->willReturn($loader);

        return $twig;
    }
}