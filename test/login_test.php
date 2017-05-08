<?php

class login_test extends PHPunit_Framework_Testcase {

    public function isauthenticated_Page(){       
		$this->call('GET', '/');

        $this->assertResponseOk();
        $this->assertEquals($this->response->isAuthenticated(), 'True');
    }
	public function nonauthenticated_Page(){
        
		$this->call('GET', '/');

        $this->assertResponseOk();
        $this->assertEquals($this->response->isAuthenticated(), 'False');
    }
	public function login_Page(){
		$this->request->setMethod(‘POST’)->setPost(array(
		    'username' => 'user1',
			'password' => 'abc123'			
		    ));
		$this->dispatch(‘/user/login’);
		$this->assertRedirect;
		$this->assertResponseOk();
	}
	public function log_outAuthenticated(){
		
		$this->assertEquals($this->response->isAuthenticated(), 'True');
		$this->assertResponseOk();
		$this->CanAccess(‘/user/logout’);
	}
	public function log_outnonAuthenticated(){
		
		$this->assertEquals($this->response->isAuthenticated(), 'False');
		$this->assertResponseOk();
		$this->CanNotAccess(‘/user/logout’);
	}

}
?>