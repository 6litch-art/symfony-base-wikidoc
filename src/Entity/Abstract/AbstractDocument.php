<?php

namespace Base\Wikidoc\Entity\Abstract;

use Base\Wikidoc\Repository\Abstract\AbstractDocumentRepository;
use Base\Annotations\Annotation\Hierarchify;
use Base\Database\Annotation\Cache;
use Base\Entity\Thread;
use Base\Service\Model\LinkableInterface;
use Doctrine\ORM\Mapping as ORM;
use Base\Database\Annotation\DiscriminatorEntry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @ORM\Entity(repositoryClass=AbstractDocumentRepository::class)
 *
 * @Cache(usage="NONSTRICT_READ_WRITE", associations="ALL")
 *
 * @DiscriminatorEntry()
 * @Hierarchify(hierarchy = {"wikidoc"}, separator = "/" );
 */
abstract class AbstractDocument extends Thread implements LinkableInterface
{
    public static function __iconizeStatic(): ?array
    {
        return ['fa-solid fa-book'];
    }

    public function __toLink(array $routeParameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): ?string
    {
        $routeName = 'backoffice_manual';
        $routeParameters = array_merge($routeParameters, ['slug' => $this->getSlug()]);

        return $this->getRouter()->generate($routeName, $routeParameters, $referenceType);
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $icon;

    public function getIcon(): ?string
    {
        return $this->icon ?? $this->__iconize()[0] ?? $this->__iconizeStatic()[0] ?? null;
    }

    /**
     * @param string|null $icon
     * @return $this
     */
    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @ORM\Column(type="integer")
     */
    protected $priority;

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }
}
