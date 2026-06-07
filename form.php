<div class="container">

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($erro); ?></div>
    <?php endif; ?>

    <form action="?controller=ContatosController&<?php
        echo isset($contato->id)
            ? "method=atualizar&id={$contato->id}"
            : "method=salvar";
    ?>" method="post">
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title">Contatos</span>
            </div>
            <div class="card-body"></div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Nome: *</label>
                <input type="text" class="form-control col-sm-8" name="nome" id="nome"
                       value="<?php echo htmlspecialchars($contato->nome ?? ''); ?>" required />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Telefone:</label>
                <input type="text" class="form-control col-sm-8" name="telefone" id="telefone"
                       value="<?php echo htmlspecialchars($contato->telefone ?? ''); ?>" />
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Email:</label>
                <input type="email" class="form-control col-sm-8" name="email" id="email"
                       value="<?php echo htmlspecialchars($contato->email ?? ''); ?>" />
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" id="id"
                       value="<?php echo $contato->id ?? ''; ?>" />
                <button class="btn btn-success" type="submit">Salvar</button>
                <a class="btn btn-danger" href="?controller=ContatosController&method=listar">Cancelar</a>
            </div>
        </div>
    </form>
</div>
