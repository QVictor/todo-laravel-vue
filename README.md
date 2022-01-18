# Training project "Laravel TodoList with vue components"

## run project

In directory project run command

    mv .env.example .env
    composer install --ignore-platform-reqs
    alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
    sail up
    sail artisan migrate

Open project in http://localhost

For LiveReload use command

    npm run hot
