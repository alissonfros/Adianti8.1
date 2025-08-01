<?php
/**
 * Sale
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class Sale extends TRecord
{
    const TABLENAME = 'sale';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    
    private $customer;
    private $status;
    private $sale_items;

    /**
     * Constructor method
     */
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        parent::addAttribute('date');
        parent::addAttribute('total');
        parent::addAttribute('obs');
        parent::addAttribute('status_id');
        parent::addAttribute('customer_id');
    }

    
    /**
     * Method set_customer
     * Sample of usage: $sale->customer = $object;
     * @param $object Instance of Customer
     */
    public function set_customer(Customer $object)
    {
        $this->customer = $object;
        $this->customer_id = $object->id;
    }
    
    /**
     * Method get_customer
     * Sample of usage: $sale->customer->attribute;
     * @returns Customer instance
     */
    public function get_customer()
    {
        // loads the associated object
        if (empty($this->customer))
            $this->customer = new Customer($this->customer_id);
    
        // returns the associated object
        return $this->customer;
    }
    
    /**
     * Method get_status
     * Sample of usage: $sale->status->attribute;
     * @returns SaleStatus instance
     */
    public function get_status()
    {
        // loads the associated object
        if (empty($this->status))
            $this->status = new SaleStatus($this->status_id);
    
        // returns the associated object
        return $this->status;
    }
    
    /**
     * Method get_customer_name
     */
    public function get_customer_name()
    {
        return $this->get_customer()->name;
    }

    public function getSaleItems()
    {
        return SaleItem::where('sale_id', '=', $this->id)->load();
    }
    
    /**
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        // delete the related SaleItem objects
        $id = isset($id) ? $id : $this->id;
        SaleItem::where('sale_id', '=', $id)->delete();
        
        // delete the object itself
        parent::delete($id);
    }

    public static function getCustomerSales($customer_id)
    {
        $repository = new TRepository('Sale');
        return $repository->where('customer_id', '=', $customer_id)->load();
    }
}
