<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Braintree
 *
 * @ORM\Table(name="braintree")
 * @ORM\Entity
 */
class Braintree
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="merchant_id", type="string", length=40, nullable=false)
     */
    private $merchantId;

    /**
     * @var string
     *
     * @ORM\Column(name="public_key", type="string", length=30, nullable=false)
     */
    private $publicKey;

    /**
     * @var string
     *
     * @ORM\Column(name="private_key", type="string", length=70, nullable=false)
     */
    private $privateKey;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): self
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    public function getPublicKey(): ?string
    {
        return $this->publicKey;
    }

    public function setPublicKey(string $publicKey): self
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    public function getPrivateKey(): ?string
    {
        return $this->privateKey;
    }

    public function setPrivateKey(string $privateKey): self
    {
        $this->privateKey = $privateKey;

        return $this;
    }


}
