<?php

	 /**
	  * 
	  * Céu Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * Notification
	  *
	  * @author Andre Araujo
	  */
	 class Notification {

		 private $from;
		 private $notification;
		 private $date;
		 private $icon;
		 private $link;

		 public function __construct($from, $notification, $date, $link = null, $icon = 'fa fa-bell') {
			 $this->from = $from;
			 $this->notification = $notification;
			 $this->date = $date;
			 $this->link = $link;
			 $this->icon = $icon;
		 }

		 public function getFrom() {
			 return $this->from;
		 }

		 public function getNotification() {
			 return $this->notification;
		 }

		 public function getDate() {
			 return $this->date;
		 }

		 public function getLink() {
			 return is_array($this->link) ? $this->link : '#';
		 }

		 public function getIcon() {
			 return $this->icon;
		 }

		 public function setFrom($from) {
			 $this->from = $from;
		 }

		 public function setNotification($notification) {
			 $this->notification = $notification;
		 }

		 public function setDate($date) {
			 $this->date = $date;
		 }

		 public function setLink($link) {
			 $this->link = $link;
		 }

		 public function setIcon($icon) {
			 $this->icon = $icon;
		 }

	 }
	 