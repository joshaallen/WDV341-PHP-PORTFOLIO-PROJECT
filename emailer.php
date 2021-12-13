<?php
    /*
                Project Emailer Class
				Author: Joshua Allen
				Date: November 6, 2018
    */
    class Emailer
    {
        //Properties
        private $sendersAddress;
        private $sendToAddress;
        private $subjectLine;
        private $message;
        
        //constructors
        public function __construct(){}
    
        //Getters Setters
        public function set_sendersAddress($new_sendersAddress) {
            $this->sendersAddress = $new_sendersAddress;
        }
       
        public function get_sendersAddress() {
            return $this->sendersAddress;
        }
        
        public function set_sendToAddress($new_sendToAddress) {
            $this->sendToAddress = $new_sendToAddress;
        }
        
        public function get_sendToAddress() {
            return $this->sendToAddress;
        }
        
        public function set_subjectLine($new_subjectLine) {
            $this->subjectLine = $new_subjectLine;
        }

        public function get_subjectLine() {
            return $this->subjectLine;
        }
        
        public function set_message($new_message) {
            $this->message = $new_message;
        }
        
        public function get_message() {
            return $this->message;
        }
        //method
        public function sendEmail($mailTo) {
            $headers = "From: ".$this->get_sendersAddress();
            $txt = "You have recieved an e-mail from ".$this->get_subjectLine().".\n\n".$this->get_message();
            $subject = $this->get_subjectLine()." has a comment";
            mail($mailTo, $subject, $txt, $headers);
        }
    }//end Emailer Class
?>