<section id="main">

    <div class="container container-main">
        <h2 class="form-title">Search Users</h2>

        <form id="support-form" action="search" method="get">
            <!-- Treba promeniti action atribut forme da vodi ka skripti
            koja ce da handle-uje user input. -->

            <div class="form-field">
                <input type="text" class="block margin-center minw-400px"
                id="search"
                name="username" value="" placeholder="search">
            </div>

            <div class="button button-submit margin-center">
                <input type="submit" class="block minw-100px margin-center"
                name="" value="Submit">
            </div>
        </form>

        <?php
            if(!empty($users)) {
                foreach ($users as $user_id => $username) {
                    echo '<p><a href="user_profile?id=' . $user_id . '">' . $username .'</a></p>';
                }
            }
            else {
                echo "<p>Sorry, we could not find what you are searching for.</p>";
            }
        ?>

    </div>

</section>
