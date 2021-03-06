<?php

class LCB_Kiyoh_Block_Review extends Mage_Core_Block_Template {

    public $data;

    protected function _init($connectorCode, $companyId)
    {

        try {

            $cache = Mage::app()->getCache();
            $cacheKey = "lcb_kiyoh_$companyId";
            $xml = $cache->load($cacheKey);

            if (!$xml) {
                $xml = simplexml_load_file("https://www.kiyoh.nl/xml/recent_company_reviews.xml?connectorcode=$connectorCode&company_id=$companyId");
            }

            $cache->save($xml, $cacheKey, array(), 60*60*4);
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
