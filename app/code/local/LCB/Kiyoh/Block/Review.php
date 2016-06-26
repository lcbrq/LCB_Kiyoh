<?php

class LCB_Kiyoh_Block_Review extends Mage_Core_Block_Template {

    public $data;

    protected function _init($connectorCode, $companyId)
    {

        try {

            $cache = Mage::app()->getCache();
            $xml = $cache->load("lcb_kiyoh");

            if (!$xml) {
                $xml = simplexml_load_file("https://www.kiyoh.nl/xml/recent_company_reviews.xml?connectorcode=$connectorCode&company_id=$companyId");
            }

            $this->data = $xml;
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

    public function getCompany()
    {
        return $this->data->company;
    }

}
