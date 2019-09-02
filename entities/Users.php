<?php



/**
 * Users
 */
/**
 * @Entity @Table(name="users")
 **/
class Users
{
    /**
     * @var string|null
     */
    /** @Column(type="string") **/
    private $name;
    
    /**
     * @var string|null
     */
    /** @Column(type="string") **/
    private $post_number;
    
    /**
     * @var int
     */
    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;


    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Users
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set postNumber.
     *
     * @param string|null $post_number
     *
     * @return Users
     */
    public function setPostNumber($post_number = null)
    {
        $this->post_number = $post_number;

        return $this;
    }

    /**
     * Get postNumber.
     *
     * @return string|null
     */
    public function getPostNumber()
    {
        return $this->post_number;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}


class MyRepository extends Doctrine\ORM\EntityRepository {
    public function findByExample(MyEntity $entity) {
        return $this->findBy($entity->toArray());
    }
    /**
     * @var string|null
     */
    private $post_number;


}
