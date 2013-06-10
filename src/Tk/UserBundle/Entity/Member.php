<?php

namespace Tk\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tk\UserBundle\Entity\MemberRepository")
 */
class Member
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="invitationToken", type="string", length=255, nullable=true)
     */
    private $invitationToken;

    /**
     * @ORM\ManyToOne(targetEntity="Tk\GroupBundle\Entity\TGroup", inversedBy="members", cascade={"persist"})
     */
    protected $tgroup;

    /**
     * @ORM\ManyToOne(targetEntity="Tk\UserBundle\Entity\User", inversedBy="members", cascade={"persist"})
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Tk\ExpenseBundle\Entity\Expense", mappedBy="owner", cascade={"persist"})
     */
    protected $myExpenses;
    
    /**
     * @ORM\ManyToMany(targetEntity="Tk\ExpenseBundle\Entity\Expense", mappedBy="users", cascade={"persist"})
     */
    protected $ForMeExpenses;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Member
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set invitationToken
     *
     * @param string $invitationToken
     * @return Member
     */
    public function setInvitationToken($invitationToken)
    {
        $this->invitationToken = $invitationToken;

        return $this;
    }

    /**
     * Get invitationToken
     *
     * @return string 
     */
    public function getInvitationToken()
    {
        return $this->invitationToken;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myExpenses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ForMeExpenses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Generate invitationToken
     *
     * @return string 
     */
    public function generateInvitationToken()
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < 30; $i++) {
            $key .= $keys[array_rand($keys)];
        }

    return $key;
    }

    /**
     * Set tgroup
     *
     * @param \Tk\GroupBundle\Entity\TGroup $tgroup
     * @return Member
     */
    public function setTgroup(\Tk\GroupBundle\Entity\TGroup $tgroup = null)
    {
        $this->tgroup = $tgroup;

        return $this;
    }

    /**
     * Get tgroup
     *
     * @return \Tk\GroupBundle\Entity\TGroup 
     */
    public function getTgroup()
    {
        return $this->tgroup;
    }

    /**
     * Set user
     *
     * @param \Tk\UserBundle\Entity\User $user
     * @return Member
     */
    public function setUser(\Tk\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Tk\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add myExpenses
     *
     * @param \Tk\ExpenseBundle\Entity\Expense $myExpenses
     * @return Member
     */
    public function addMyExpense(\Tk\ExpenseBundle\Entity\Expense $myExpenses)
    {
        $this->myExpenses[] = $myExpenses;

        return $this;
    }

    /**
     * Remove myExpenses
     *
     * @param \Tk\ExpenseBundle\Entity\Expense $myExpenses
     */
    public function removeMyExpense(\Tk\ExpenseBundle\Entity\Expense $myExpenses)
    {
        $this->myExpenses->removeElement($myExpenses);
    }

    /**
     * Get myExpenses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyExpenses()
    {
        return $this->myExpenses;
    }

    /**
     * Add ForMeExpenses
     *
     * @param \Tk\ExpenseBundle\Entity\Expense $forMeExpenses
     * @return Member
     */
    public function addForMeExpense(\Tk\ExpenseBundle\Entity\Expense $forMeExpenses)
    {
        $this->ForMeExpenses[] = $forMeExpenses;

        return $this;
    }

    /**
     * Remove ForMeExpenses
     *
     * @param \Tk\ExpenseBundle\Entity\Expense $forMeExpenses
     */
    public function removeForMeExpense(\Tk\ExpenseBundle\Entity\Expense $forMeExpenses)
    {
        $this->ForMeExpenses->removeElement($forMeExpenses);
    }

    /**
     * Get ForMeExpenses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getForMeExpenses()
    {
        return $this->ForMeExpenses;
    }
}
