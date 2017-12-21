<?php

	class AutenticacaoGruposController extends AutenticacaoAppController {

		public function admin_add() {
			throw new ForbiddenException();
		}

		public function admin_edit($id = null) {
			if ($this->AutenticacaoGrupo->exists($id)) {
				if ($this->request->is('put')) {
					if ($this->AutenticacaoGrupo->save($this->request->data)) {
						$this->alerta('As informações foram gravadas com sucesso.');
						$this->redirect(array('action' => 'admin_index'));
					} else {
						$this->alerta('Foram encontrados erros, corrija-os e salve novamente.');
					}
				} else {
					$this->AutenticacaoGrupo->Behaviors->attach('Containable');
					$conditions = array('id' => $id);
					$contain = array('AutenticacaoPermissao');
					$this->request->data = $this->AutenticacaoGrupo->find('first', compact('conditions', 'contain'));
				}
				//Permissoes
				$fields = array('AutenticacaoPermissao.id', 'AutenticacaoPermissao.titulo');
				$order = 'AutenticacaoPermissao.titulo ASC';
				$autenticacaoPermissaos = $this->AutenticacaoGrupo->AutenticacaoPermissao->find('list', compact('fields', 'order'));
				$this->set(compact('autenticacaoPermissaos'));
			} else {
				throw new NotFoundException(sprintf('Registro id #%d não encontrado.', $id));
			}
		}

		public function admin_delete($id = null) {
			throw new ForbiddenException();
		}

	}

?>