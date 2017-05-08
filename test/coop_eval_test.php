<?php

class coop_test_test extends PHPunit_Framework_Testcase {

    public function getStudentEvaluation(){       
		$this->call('GET', '/');

        $this->assertResponseOk();
        $this->assertEquals($this->response->getStudentEval(), 'put stubs here');
    }
	
	public function getStudentEvaluation(){       
		$this->call('GET', '/');

        $this->assertResponseOk();
        $this->assertEquals($this->response->getEmployerEval(), 'put stubs here');
    }
	public function studentEvalmatchesID(){
        
		$this->call('GET', '/');

        $this->assertResponseOk();
		$this->assertEquals($this->response->student.getID(), 'stub data');
        $this->assertEquals($this->response->isAuthenticated(), 'True');
    }
	public function EmployerEvalmatchesID(){
        
		$this->call('GET', '/');

        $this->assertResponseOk();
		$this->assertEquals($this->response->employer.getID(), 'stub data');
        $this->assertEquals($this->response->isAuthenticated(), 'True');
    }
	public function unauthorizedAccessEval(){
        
		$this->call('GET', '/');
        $this->assertEquals($this->response->isAuthenticated(), 'False');
    }
	public function noEvaluationexistsforID(){
        
		$this->call('GET', '/');
		$this->assertEquals($this->response->student.getID(), 'stub data');
        $this->assertEquals($this->response->isAuthenticated(), 'True');
		$this->assertEquals($this->response->getStudentEval(), null);
    }
    public function noEvaluationexistsforID(){
        
		$this->call('GET', '/');
		$this->assertEquals($this->response->employer.getID(), 'stub data');
        $this->assertEquals($this->response->isAuthenticated(), 'True');
		$this->assertEquals($this->response->getEmployerEval(), null);
    }
	public function updateStudentEvaluation(){
		$this->request->setMethod(‘POST’)->setPost(array(
		    //TODO add fields for evaluation		
		    ));
		$this->dispatch(‘/user/studentevaluation’);
		$this->assertRedirect;
		$this->assertResponseOk();
	}
	public function updateEmployerEvaluation(){
		$this->request->setMethod(‘POST’)->setPost(array(
		    //TODO add fields for evaluation		
		    ));
		$this->dispatch(‘/user/employerevaluation’);
		$this->assertRedirect;
		$this->assertResponseOk();
	}
}
?>