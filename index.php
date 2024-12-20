<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
    <div class="row">
        <div class="login-container">
            <ion-app>
                <ion-content class="ion-padding">
                    <ion-card class="col s12 m8 offset-m2 l6 offset-l3">
                        <ion-card-header>
                            <ion-card-title class="ion-text-center">Login</ion-card-title>
                        </ion-card-header>

                        <ion-card-content>
                            <form action="login.php" method="post">
                                <ion-item>
                                    <ion-label position="floating">Nome de Usuário</ion-label>
                                    <ion-input type="text" name="username" required></ion-input>
                                </ion-item>

                                <ion-item>
                                    <ion-label position="floating">Senha</ion-label>
                                    <ion-input type="password" name="password" required></ion-input>
                                </ion-item>

                                <ion-button expand="block" type="submit" class="ion-margin-top">
                                    Entrar
                                </ion-button>
                            </form>
                        </ion-card-content>
                    </ion-card>
                </ion-content>
            </ion-app>
        </div>
    </div>
    <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ionic/core/css/ionic.bundle.css"/>
</body>
</html>