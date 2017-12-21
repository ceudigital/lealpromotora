<?php

	class AutenticacaoPermissoesController extends AutenticacaoAppController {

		public $uses = 'Autenticacao.AutenticacaoPermissao';

		public function admin_index() {
			$this->AutenticacaoPermissao->Behaviors->attach('Containable');
			$this->paginate = array(
				'contain' => array(
					'AutenticacaoGrupo' => array(
						'fields' => 'descricao',
						'order' => 'AutenticacaoGrupo.descricao ASC',
					),
				)
			);
			$this->set('autenticacaoPermissoes', $this->paginate($this->Search->getConditions()));
		}

		public function admin_add() {
			throw new ForbiddenException();
		}

		public function admin_edit($id = null) {
			if ($this->AutenticacaoPermissao->exists($id)) {
				if ($this->request->is('put')) {
					if ($this->AutenticacaoPermissao->save($this->request->data)) {
						$this->alerta('As informações foram gravadas com sucesso.');
						$this->redirect(array('action' => 'admin_index'));
					} else {
						$this->alerta('Foram encontrados erros, corrija-os e salve novamente.');
					}
				} else {
					$this->AutenticacaoPermissao->Behaviors->attach('Containable');
					$conditions = array('id' => $id);
					$contain = array('AutenticacaoGrupo');
					$this->request->data = $this->AutenticacaoPermissao->find('first', compact('conditions', 'contain'));
				}
				//Grupos
				$fields = array('AutenticacaoGrupo.id', 'AutenticacaoGrupo.descricao');
				$order = 'AutenticacaoGrupo.descricao ASC';
				$autenticacaoGrupos = $this->AutenticacaoPermissao->AutenticacaoGrupo->find('list', compact('fields', 'order'));
				$this->set(compact('autenticacaoGrupos'));
			} else {
				throw new NotFoundException(sprintf('Registro id #%d não encontrado.', $id));
			}
		}

		public function admin_delete($id = null) {
			throw new ForbiddenException();
		}

	}

?>