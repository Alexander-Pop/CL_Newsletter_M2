<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Alex P <alexander@codelegacy.com> <@>
 * @copyright Copyright (c) 2019 Codelegacy (http://codelegacy.com)
 */

namespace Codelegacy\Newsletter\Model;

use Magento\Newsletter\Model\SubscriberFactory;

class Subscription implements \Codelegacy\Newsletter\Api\Data\SubscriptionInterface
{
    /**
     * @var SubscriberFactory
     */
    private $subscriberFactory;

    /**
     * Subscription constructor.
     * @param SubscriberFactory $subscriberFactory
     */
    public function __construct(
        SubscriberFactory $subscriberFactory
    ) {
        $this->subscriberFactory = $subscriberFactory;
    }

    /**
     * @param string $email
     * @return \Codelegacy\Newsletter\Api\Data\save|void
     * @throws \Exception
     */
    public function save($email)
    {
        $subscribe = $this->subscriberFactory->create();
        $subscribe->subscribe($email) ;
    }

    /**
     * @param $customerId
     * @return mixed
     */
    public function delete($customerId)
    {
        $subscribe = $this->subscriberFactory->create();
        $subscribe->unsubscribeCustomerById($customerId) ;
    }

    /**
     * @param string $email
     * @return mixed|void
     * @throws \Exception
     */
    public function updateStatus(string $email)
    {
        $subscribe = $this->subscriberFactory->create();
        $subscribe->loadByEmail($email);
        $subscribe->setStatus(\Magento\Newsletter\Model\Subscriber::STATUS_UNSUBSCRIBED);
        $subscribe->save();
    }
}