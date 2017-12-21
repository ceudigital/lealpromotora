<?php

	 App::uses('Notification', 'Admin.Lib');

	 /**
	  * 
	  * C�u Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * Notifications
	  *
	  * @author Andre Araujo
	  */
	 abstract class Notifications {

		 /**
		  * Lista de notifica��es
		  * @var type 
		  */
		 private static $notifications = array();

		 /**
		  * Limpar as notifica��es
		  */
		 public static function clear() {
			 self::$notifications = array();
		 }

		 /**
		  * Incluir uma notifica��o
		  * @param Notification $userNotification
		  */
		 public static function add(Notification $userNotification) {
			 array_push(self::$notifications, $userNotification);
		 }

		 /**
		  * Ler as notifica��es
		  * @return array
		  */
		 public static function read() {
			 return self::$notifications;
		 }

	 }
	 