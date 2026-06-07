<div class="container mt-4">

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo htmlspecialchars($erro); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <form action="?controller=UsuariosController&<?php
        echo isset($usuario->id)
            ? "method=atualizar&id={$usuario->id}"
            : "method=salvar";
    ?>" method="post">

        <div class="card mt-3">
            <div class="card-header">
                <strong><?php echo isset($usuario->id) ? 'Editar Usuário' : 'Novo Usuário'; ?></strong>
            </div>

            <div class="card-body">
                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label text-right">Nome: *</label>
                    <input type="text" class="form-control col-sm-8" name="nome"
                           value="<?php echo htmlspecialchars($usuario->nome ?? ''); ?>" required />
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label text-right">Email: *</label>
                    <input type="email" class="form-control col-sm-8" name="email"
                           value="<?php echo htmlspecialchars($usuario->email ?? ''); ?>" required />
                </div>

                <?php if (!isset($usuario->id)): ?>
                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label text-right">Senha: *</label>
                    <input type="password" class="form-control col-sm-8" name="senha"
                           minlength="6" required />
                    <small class="col-sm-8 offset-sm-2 text-muted">Mínimo 6 caracteres.</small>
                </div>

                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label text-right">Confirmar Senha: *</label>
                    <input type="password" class="form-control col-sm-8" name="confirmar_senha"
                           minlength="6" required />
                </div>
                <?php endif; ?>

                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label text-right">Ativo:</label>
                    <div class="col-sm-8 pt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ativo" value="1"
                                <?php echo (!isset($usuario->ativo) || $usuario->ativo) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ativo" value="0"
                                <?php echo (isset($usuario->ativo) && !$usuario->ativo) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Não</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save"></i> Salvar
                </button>
                <a class="btn btn-danger" href="?controller=UsuariosController&method=listar">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
