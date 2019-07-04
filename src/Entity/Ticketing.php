<?php


namespace App\Entity;

use Mapado\RestClientSdk\Mapping\Annotations as Rest;
use Symfony\Component\Intl\Intl;

/**
 * @Rest\Entity(key="ticketings")
 */
class Ticketing
{
    public const AVAILABILITY_STATUS_ON_SALE = 'onSale';
    public const AVAILABILITY_STATUS_SOLD_OUT = 'soldOut';
    public const AVAILABILITY_STATUS_PAST_OR_CLOSED = 'pastOrClosed';
    public const AVAILABILITY_STATUS_CONTRACT_NOT_APPROVED = 'contractNotApproved';
    public const AVAILABILITY_STATUS_NO_TICKET_PRICE = 'noTicketPrice';
    public const AVAILABILITY_STATUS_OTHER = 'other';
    /**
     * id
     *
     * @Rest\Id
     * @Rest\Attribute(name="@id", type="string")
     * Groups({"ticketing"})
     *
     * @var string
     */
    private $id;
    /**
     * currency
     *
     * @Rest\Attribute(name="currency", type="string")
     * Groups({"ticketing"})
     *
     * @var string
     */
    private $currency;
    /**
     * availabilityStatus
     *
     * @Rest\Attribute(name="availabilityStatus", type="string")
     * Groups({"ticketing"})
     *
     * @var string
     */
    private $availabilityStatus;
    /**
     * timezone
     *
     * @Rest\Attribute(name="timezone", type="string")
     * Groups({"ticketing"})
     *
     * @var string
     */
    private $timezone;
    /**
     * Three states:
     * NULL when no eventDate
     * True when only one eventDate without a startDate is allowed
     * False when only eventdates with startDates are allowed
     *
     * @Rest\Attribute(name="permanent", type="boolean")
     * Groups({"ticketing"})
     *
     * @var bool
     */
    private $permanent;
    /**
     * @Rest\Attribute(name="title", type="string")
     * Groups({"ticketing"})
     */
    private $title;
    /**
     * @Rest\Attribute(name="slug", type="string")
     * Groups({"ticketing"})
     */
    private $slug;
    /**
     * @Rest\Attribute(name="description", type="string")
     * Groups({"ticketing"})
     */
    private $description;
    /**
     * @Rest\Attribute(name="place", type="string")
     * Groups({"ticketing"})
     */
    private $place;
    /**
     * @Rest\Attribute(name="address", type="float")
     * Groups({"ticketing"})
     */
    private $address;
    /**
     * @Rest\Attribute(name="city", type="string")
     * Groups({"ticketing"})
     */
    private $city;
    /**
     * @Rest\Attribute(name="citySlug", type="string")
     * Groups({"ticketing"})
     */
    private $citySlug;
    /**
     * @Rest\Attribute(name="countryCode", type="string")
     * Groups({"ticketing"})
     */
    private $countryCode;
    /**
     * @Rest\Attribute(name="imageList", type="array")
     * Groups({"ticketing"})
     */
    private $imageList;
    /**
     * @Rest\Attribute(name="schedule", type="string")
     * Groups({"ticketing"})
     */
    private $schedule;
    /**
     * @Rest\Attribute(name="isOnSale", type="boolean")
     * Groups({"ticketing"})
     *
     * @var bool
     */
    private $isOnSale;
    /**
     * @Rest\Attribute(name="hasTicketPriceOnSale", type="boolean")
     * Groups({"ticketing"})
     *
     * @var bool
     */
    private $hasTicketPriceOnSale;
    /**
     * firstFutureEventDateStartDate
     *
     * @var string
     *
     * @Rest\Attribute(name="firstFutureEventDateStartDate", type="string")
     * Groups({"ticketing"})
     */
    private $firstFutureEventDateStartDate;
    /**
     * lastPastEventDateStartDate
     *
     * @var string
     *
     * @Rest\Attribute(name="lastPastEventDateStartDate", type="string")
     * Groups({"ticketing"})
     */
    private $lastPastEventDateStartDate;
    /**
     * Getter for id
     *
     * return string
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Setter for id
     *
     * @param string $id
     *
     * @return Ticketing
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Getter for currency
     *
     * return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Getter for timezone
     *
     * return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
    /**
     * Setter for timezone
     *
     * @param string $timezone
     *
     * @return Ticketing
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }
    /**
     * Get currency symbol corresponding to the currency code
     *
     * Groups({"ticketing"})
     *
     * @return string
     */
    public function getCurrencySymbol($locale = null)
    {
        $currencySymbol = Intl::getCurrencyBundle()->getCurrencySymbol($this->getCurrency(), $locale);
        if ($currencySymbol) {
            return $currencySymbol;
        }
        return $this->getCurrency();
    }
    /**
     * Set permanent
     *
     * @param bool $permanent
     *
     * @return Ticketing
     */
    public function setPermanent($permanent)
    {
        $this->permanent = $permanent;
        return $this;
    }
    /**
     * Get permanent
     *
     * @return bool
     */
    public function getPermanent()
    {
        return $this->permanent;
    }
    /**
     * Get permanent
     *
     * @return bool
     */
    public function isPermanent()
    {
        return $this->permanent;
    }
    /**
     * Gets the value of isOnSale.
     *
     * @return bool
     */
    public function getIsOnSale()
    {
        return $this->isOnSale;
    }
    /**
     * Sets the value of isOnSale.
     *
     * @return Ticketing
     */
    public function setIsOnSale($isOnSale)
    {
        $this->isOnSale = $isOnSale;
        return $this;
    }
    /**
     * Sets the value of hasTicketPriceOnSale.
     *
     * @return Ticketing
     */
    public function setHasTicketPriceOnSale($hasTicketPriceOnSale)
    {
        $this->hasTicketPriceOnSale = $hasTicketPriceOnSale;
        return $this;
    }
    /**
     * Gets the value of images.
     *
     * @return mixed
     */
    public function getImageList()
    {
        return $this->imageList;
    }
    /**
     * Sets the value of imageList.
     *
     * @param mixed $imageList the imageList
     *
     * @return self
     */
    public function setImageList($imageList)
    {
        if (is_string($imageList)) {
            $imageList = explode(',', $imageList);
        }
        $this->imageList = $imageList;
        return $this;
    }
    /**
     * Gets the value of schedule.
     *
     * @return mixed
     */
    public function getSchedule()
    {
        return $this->schedule;
    }
    /**
     * Sets the value of schedule.
     *
     * @param mixed $schedule the schedule
     *
     * @return self
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
        return $this;
    }
    /**
     * Gets the value of citySlug.
     *
     * @return mixed
     */
    public function getCitySlug()
    {
        return $this->citySlug;
    }
    /**
     * Sets the value of citySlug.
     *
     * @param mixed $citySlug the city slug
     *
     * @return self
     */
    public function setCitySlug($citySlug)
    {
        $this->citySlug = $citySlug;
        return $this;
    }
    /**
     * Gets the value of city.
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * Sets the value of city.
     *
     * @param mixed $city the city
     *
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
    /**
     * Gets the value of address.
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }
    /**
     * Sets the value of address.
     *
     * @param mixed $address the address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    /**
     * Gets the value of place.
     *
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }
    /**
     * Sets the value of place.
     *
     * @param mixed $place the place
     *
     * @return self
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }
    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Gets the value of slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Sets the value of slug.
     *
     * @param mixed $slug the slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Gets the availabilityStatus.
     *
     * @return string
     */
    public function getAvailabilityStatus()
    {
        return $this->availabilityStatus;
    }
    /**
     * Sets the availabilityStatus.
     *
     * @param string $availabilityStatus the availability status
     *
     * @return self
     */
    public function setAvailabilityStatus($availabilityStatus)
    {
        $this->availabilityStatus = $availabilityStatus;
        return $this;
    }
    /**
     * Gets the isSoldOut
     *
     * @return bool
     */
    public function isSoldOut()
    {
        return $this->availabilityStatus === self::AVAILABILITY_STATUS_SOLD_OUT;
    }
    /**
     * Gets the isSoldOut
     *
     * @return bool
     */
    public function hasTicketPriceList()
    {
        return $this->availabilityStatus !== self::AVAILABILITY_STATUS_NO_TICKET_PRICE;
    }
    /**
     * Gets the value of countryCode.
     *
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
    /**
     * Sets the value of countryCode.
     *
     * @param mixed $countryCode the city slug
     *
     * @return self
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }
    /**
     * Sets firstFutureEventDateStartDate
     *
     * @return self
     */
    public function setFirstFutureEventDateStartDate($firstFutureEventDateStartDate)
    {
        $this->firstFutureEventDateStartDate = $firstFutureEventDateStartDate;
        return $this;
    }
    /**
     * Getter for firstFutureEventDateStartDate
     *
     * @return ?string
     */
    public function getFirstFutureEventDateStartDate()
    {
        return $this->firstFutureEventDateStartDate;
    }
    /**
     * Sets lastPastEventDateStartDate
     *
     * @return self
     */
    public function setLastPastEventDateStartDate($lastPastEventDateStartDate)
    {
        $this->lastPastEventDateStartDate = $lastPastEventDateStartDate;
        return $this;
    }
    /**
     * Getter for lastPastEventDateStartDate
     *
     * @return ?string
     */
    public function getLastPastEventDateStartDate()
    {
        return $this->lastPastEventDateStartDate;
    }
}
