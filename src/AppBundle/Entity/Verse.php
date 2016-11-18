<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="verses",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="verse_number_psalm_unique", columns={"number", "psalm_id"})}
 * )
 */
class Verse
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
     * @ORM\Column(type="text")
     */
    protected $verse;

    /**
     * @ORM\Column(type="text")
     */
    protected $verseFrench;

    /**
     * @ORM\Column(type="text")
     */
    protected $versePhonetic;

    /**
     * @ORM\Column(type="text")
     */
    protected $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Psalm", inversedBy="verses")
     * @var Psalm
     */
    protected $psalm;

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
    public function getVerse()
    {
        return $this->verse;
    }

    /**
     * @param mixed $verse
     */
    public function setVerse($verse)
    {
        $this->verse = $verse;
    }

    /**
     * @return mixed
     */
    public function getVerseFrench()
    {
        return $this->verseFrench;
    }

    /**
     * @param mixed $verseFrench
     */
    public function setVerseFrench($verseFrench)
    {
        $this->verseFrench = $verseFrench;
    }

    /**
     * @return mixed
     */
    public function getVersePhonetic()
    {
        return $this->versePhonetic;
    }

    /**
     * @param mixed $versePhonetic
     */
    public function setVersePhonetic($versePhonetic)
    {
        $this->versePhonetic = $versePhonetic;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return Psalm
     */
    public function getPsalm()
    {
        return $this->psalm;
    }

    /**
     * @param Psalm $psalm
     */
    public function setPsalm($psalm)
    {
        $this->psalm = $psalm;
    }

}
