<?php

class company_test extends PHPunit_Framework_Testcase {
	public function addCompany(){
		$this->request->setMethod(‘POST’)->setPost(array(
		    'companyID' => '12356',
			'summary' => 'this will include the company name and summary'	
		    ));
		$this->dispatch(‘/updateCompanies’);
		$this->assertRedirect;
		$this->assertResponseOk();
	}
	public function updateCompanies(){       
    //TODO need to figure out from data structure for this
    }

}
?>