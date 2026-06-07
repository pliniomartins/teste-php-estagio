<?php

class ContatosController extends Controller
{
    /**
     * Lista os contatos ativos, com suporte a busca por nome
     */
    public function listar()
    {
        try {
            $busca    = $this->request->busca ?: null;
            $contatos = Contato::all($busca);
            $flash    = Controller::getFlash();
            return $this->view('grade', [
                'contatos' => $contatos,
                'flash'    => $flash,
                'busca'    => $busca,
            ]);

        } catch (RuntimeException $e) {
            $this->exibirErro($e->getMessage());
        }
    }

    /**
     * Mostrar formulário para criar novo contato
     */
    public function criar()
    {
        return $this->view('form');
    }

    /**
     * Mostrar formulário para editar um contato
     */
    public function editar($dados)
    {
        try {
            $id      = (int) $dados['id'];
            $contato = Contato::find($id);

            if (!$contato) {
                throw new RuntimeException("Contato #$id não encontrado.");
            }

            return $this->view('form', ['contato' => $contato]);

        } catch (RuntimeException $e) {
            $this->exibirErro($e->getMessage());
        }
    }

    /**
     * Salvar contato e redirecionar com flash de sucesso
     */
    public function salvar()
    {
        try {
            $this->validar(['nome']);

            $contato           = new Contato;
            $contato->nome     = $this->request->nome;
            $contato->telefone = $this->request->telefone;
            $contato->email    = $this->request->email;
            $contato->save();

            $this->flash('sucesso', 'Contato salvo com sucesso!');
            $this->redirecionar('?controller=ContatosController&method=listar');

        } catch (RuntimeException $e) {
            return $this->view('form', ['erro' => $e->getMessage()]);
        }
    }

    /**
     * Atualizar contato e redirecionar com flash de sucesso
     */
    public function atualizar($dados)
    {
        try {
            $id      = (int) $dados['id'];
            $contato = Contato::find($id);

            if (!$contato) {
                throw new RuntimeException("Contato #$id não encontrado.");
            }

            $this->validar(['nome']);

            $contato->nome     = $this->request->nome;
            $contato->telefone = $this->request->telefone;
            $contato->email    = $this->request->email;
            $contato->save();

            $this->flash('sucesso', 'Contato atualizado com sucesso!');
            $this->redirecionar('?controller=ContatosController&method=listar');

        } catch (RuntimeException $e) {
            $contato = Contato::find((int) $dados['id']);
            return $this->view('form', ['contato' => $contato, 'erro' => $e->getMessage()]);
        }
    }

    /**
     * Exclusão lógica com flash de sucesso
     */
    public function excluir($dados)
    {
        try {
            $id = (int) $dados['id'];

            if (!Contato::destroy($id)) {
                throw new RuntimeException("Não foi possível excluir o contato #$id.");
            }

            $this->flash('sucesso', 'Contato excluído com sucesso!');
            $this->redirecionar('?controller=ContatosController&method=listar');

        } catch (RuntimeException $e) {
            $this->exibirErro($e->getMessage());
        }
    }

    // -------------------------------------------------------
    // Helpers privados
    // -------------------------------------------------------

    private function validar(array $campos): void
    {
        foreach ($campos as $campo) {
            if (!$this->request->$campo) {
                throw new RuntimeException("O campo '$campo' é obrigatório.");
            }
        }
    }

    private function exibirErro(string $mensagem): void
    {
        echo '<div class="container mt-3">';
        echo '<div class="alert alert-danger">' . htmlspecialchars($mensagem) . '</div>';
        echo '<a href="?controller=ContatosController&method=listar" class="btn btn-secondary">Voltar</a>';
        echo '</div>';
    }
}
