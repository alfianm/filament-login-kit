<?php

namespace AlfianM\FilamentLoginKit\Concerns;

trait HasLoginConfiguration
{
    protected ?string $sideImage = null;

    protected string $sideImagePosition = 'left';

    protected string $backgroundPosition = 'center';

    protected string $backgroundSize = 'cover';

    protected string $formPosition = 'center';

    protected string $formAlignment = 'center';

    protected string $layoutMode = 'split';

    protected float $overlayOpacity = 0.5;

    protected ?string $heading = null;

    protected ?string $subheading = null;

    public function sideImage(string $url): static
    {
        $this->sideImage = $url;
        return $this;
    }

    public function sideImagePosition(string $position): static
    {
        $this->sideImagePosition = in_array($position, ['left', 'right']) ? $position : 'left';
        return $this;
    }

    public function backgroundPosition(string $position): static
    {
        $this->backgroundPosition = $position;
        return $this;
    }

    public function backgroundSize(string $size): static
    {
        $this->backgroundSize = $size;
        return $this;
    }

    public function formPosition(string $position): static
    {
        $this->formPosition = in_array($position, ['center', 'top', 'bottom']) ? $position : 'center';
        return $this;
    }

    public function formAlignment(string $alignment): static
    {
        $this->formAlignment = in_array($alignment, ['left', 'center', 'right']) ? $alignment : 'center';
        return $this;
    }

    public function layoutMode(string $mode): static
    {
        $this->layoutMode = in_array($mode, ['split', 'overlay']) ? $mode : 'split';
        return $this;
    }

    public function overlayOpacity(float $opacity): static
    {
        $this->overlayOpacity = max(0, min(1, $opacity));
        return $this;
    }

    public function heading(string $heading): static
    {
        $this->heading = $heading;
        return $this;
    }

    public function subheading(?string $subheading): static
    {
        $this->subheading = $subheading;
        return $this;
    }

    // Getters
    public function getSideImage(): string
    {
        return $this->sideImage ?? asset('images/login-kit/side-image.jpg');
    }

    public function getSideImagePosition(): string
    {
        return $this->sideImagePosition;
    }

    public function getBackgroundPosition(): string
    {
        return $this->backgroundPosition;
    }

    public function getBackgroundSize(): string
    {
        return $this->backgroundSize;
    }

    public function getFormPosition(): string
    {
        return $this->formPosition;
    }

    public function getFormAlignment(): string
    {
        return $this->formAlignment;
    }

    public function getLayoutMode(): string
    {
        return $this->layoutMode;
    }

    public function getOverlayOpacity(): float
    {
        return $this->overlayOpacity;
    }

    public function getHeading(): ?string
    {
        return $this->heading;
    }

    public function getSubheading(): ?string
    {
        return $this->subheading;
    }
}
