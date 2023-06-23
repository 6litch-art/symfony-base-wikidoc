<?php

namespace Base\Wikidoc\Entity;

use Base\Wikidoc\Entity\Abstract\AbstractSection;
use Base\Wikidoc\Repository\DevSectionRepository;
use Base\Annotations\Annotation\Hierarchify;
use Base\Database\Annotation\Cache;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DevSectionRepository::class)
 *
 * @Cache(usage="NONSTRICT_READ_WRITE", associations="ALL")
 *
 * @Hierarchify(hierarchy = {"wikidoc", "section"}, separator = "/" );
 */
class DevSection extends AbstractSection
{
}
