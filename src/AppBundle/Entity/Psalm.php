<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="psalm",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="psalm_number_unique",columns={"number"})}
 * )
 */
class Psalm
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=3)
     */
    protected $number;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $numberHebrew;

    /**
     * @ORM\Column(type="string")
     */
    protected $meaning;

    /**
     * @ORM\Column(type="string")
     */
    protected $timing;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    protected $readingDay;

    /**
     * @ORM\Column(type="string")
     */
    protected $theme;

    /**
     * @ORM\Column(type="string")
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Verse", mappedBy="psalm")
     * @ORM\OrderBy({"number" = "ASC"})
     * @var Verse[]
     */
    protected $verses;

    public function __construct()
    {
        $this->verses = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getNumberHebrew()
    {
        return $this->numberHebrew;
    }

    /**
     * @param mixed $numberHebrew
     */
    public function setNumberHebrew($numberHebrew)
    {
        $this->numberHebrew = $numberHebrew;
    }

    /**
     * @return mixed
     */
    public function getMeaning()
    {
        return $this->meaning;
    }

    /**
     * @param mixed $meaning
     */
    public function setMeaning($meaning)
    {
        $this->meaning = $meaning;
    }

    /**
     * @return mixed
     */
    public function getTiming()
    {
        return $this->timing;
    }

    /**
     * @param mixed $timing
     */
    public function setTiming($timing)
    {
        $this->timing = $timing;
    }

    /**
     * @return mixed
     */
    public function getReadingDay()
    {
        return $this->readingDay;
    }

    /**
     * @param mixed $readingDay
     */
    public function setReadingDay($readingDay)
    {
        $this->readingDay = $readingDay;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return Verse[]
     */
    public function getVerses()
    {
        return $this->verses;
    }

    /**
     * @param Verse[] $verses
     */
    public function setVerses($verses)
    {
        $this->verses = $verses;
    }

}
