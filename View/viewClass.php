<?php

class RenderPage
{
    public string|null $layout = null;
    private array $content = [];
    private string $layoutContent;

    public function __construct(string $layout)
    {
        $this->setLayout($layout);
    }

    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }
    public function setContent($name, $content): self
    {
        $this->content[$name] = $content;

        return $this;
    }

    protected function replace($replaceStr, $content): string|null
    {
       return $this->layout = str_replace("##".strtoupper($replaceStr)."##", $content, $this->layout);
    }

    public function render(): string
    {
     foreach ($this->content as $key => $content){
        $this->layoutContent = $this->replace($key, $content);
     }
     return $this->layoutContent;
    }
}


