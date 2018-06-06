<section id="main">

    <div class="container container-main">
        <h2 class="form-title">User Support Page</h2>



        <form id="support-form" action="support" method="post">
            <!-- Treba promeniti action atribut forme da vodi ka skripti
            koja ce da handle-uje user input. -->
            <div class="form_field"><label> <?= $error_message ?> </label></div>
            <div class="form-field">
                <label for="cusomter-support">You want to:</label>
                <select id="customer-support" name="selection">
                    <option value="report-problem">Report a Problem</option>
                    <option value="reguest-feature">Request a Feature</option>
                </select>
            </div>

            <div class="form-field">
                <input type="text" class="block margin-center minw-400px"
                id="form-title"
                name="form-title" value="" placeholder="Title">
            </div>

            <div class="form-field">
                <textarea id="form-textarea"
                class="block margin-center minw-400px maxw-800px w-70"
                name="form-textarea"
                rows="12" cols="60" placeholder="Enter your message here"></textarea>
            </div>

            <div class="button button-submit margin-center">
                <input type="submit" class="block minw-100px margin-center"
                name="form-button" value="Submit">
            </div>
        </form>

    </div>

</section>
