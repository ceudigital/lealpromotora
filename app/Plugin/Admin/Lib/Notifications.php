<?php

	 App::uses('Notification', 'Admin.Lib');

	 /**
	  * 
	  * Céu Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * Notifications
	  *
	  * @author Andre Araujo
	  */
	 abstract class Notifications {

		 /**
		  * Lista de notificações
		  * @var type 
		  */
		 private static $notifications = array();

		 /**
		  * Limpar as notificações
		  */
		 public static function clear() {
			 self::$notifications = array();
		 }

		 /**
		  * Incluir uma notificação
		  * @param Notification $userNotification
		  */
		 public static function add(Notification $userNotification) {
			 array_push(self::$notifications, $userNotification);
		 }

		 /**
		  * Ler as notificações
		  * @return array
		  */
		 public static function read() {
			 return self::$notifications;
		 }

	 }
	 