<main>
    <h1>REGISTRO RED BULL PANAMA</h1>


    <?php echo form_open('home/post', array('id' => 'form', 'enctype' => 'multipar/form-data')); ?>


    <hr>
    <fieldset>
        <div class="input-content">
            <label for="names">Nombre y Apellido: </label>
            <input type="text" data-value="requiredField"  name="names" id="names" placeholder="Nombre y Apellido">
        </div>
        <div class="input-content">
            <label for="birthday">Fecha de nacimiento: </label>
            <input type="text" data-value="requiredField" name="birthday" class="datepicker" id="birthday" placeholder="DD/MM/AA">
        </div>
        <div class="input-content">
            <label for="identification">Número de Cédula </label>
            <input type="text" data-value="requiredField" name="identification" id="identification" placeholder="Número de Cédula">
        </div>
        <div class="input-content">
            <label for="phone">Número de Celular </label>
            <input type="text" data-value="requiredField" name="phone" id="phone" placeholder="Número de Celular ">
        </div>
        <div class="input-content">
            <label for="email">E-mail: </label>
            <input type="email" data-value="requiredField|email" name="email" id="email" class="email" placeholder="usuario@dominio.com">
        </div>
        <div class="input-content">
            <label for="address">Dirección: </label>
            <input type="text" data-value="requiredField" name="address" id="address" placeholder="Dirección">
        </div>
        <div class="input-content">
            <label for="college">Universidad: </label>
            <input type="text"  name="college" id="college" placeholder="Universidad">
        </div>
        <div class="input-content">
            <label for="workplace">Lugar de Trabajo: </label>
            <input type="text" name="workplace" id="workplace" placeholder="Lugar de Trabajo:">
        </div>
        <div class="input-content">
            <label for="code">Código: </label>

            <div class="content-code">
                <input maxlength="4"  data-value="requiredField" type="text" name="code-1" id="code-1" class="code" placeholder="xxxx"> -
                <input maxlength="4"  data-value="requiredField" type="text" name="code-2" id="code-2" class="code" placeholder="xxxx"> -
                <input maxlength="2"  data-value="requiredField" type="text" name="code-3" id="code-3" class="code" placeholder="xx">
            </div>
        </div>


    </fieldset>


    <button> GUARDAR</button>
    <?php echo form_fieldset_close(); ?>
    <aside class="content-error">
        <div class="error">
            <span class="close"></span>

            <div class="title"> Tiene algunos errores</div>
            <ul class="content-p"></ul>
        </div>
    </aside>
    <aside class="loading">
        <div class="spinner"></div>
    </aside>


</main>