
## About githubApp

### this application has two console command for communicate with github

#### for create a repository in github : 
        app:create-github-repo {username} {reponame}
        
#### for delete a repository in github : 
    app:delete-github-repo {username} {reponame}


## for use this commands :
### install packages :
     composer install
     
     cp .env.example .env
     
### edit your env file for docker-compose configs
##### change DB_HOST :
    DB_HOST=mysql
    
#### for example in .env file change APP_PORT to 8080  
    APP_PORT=8080
    
### and build docker : 
    alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
    
    sail up

### migration databases:
     sail artisan migrate
     
### and go to your browser and enter in address bar:
    http://localhost:8080
    
# go to login page and click on github icon to login with github
## and in dashboard page enter your personal access token generated with github
### for create personal access token
#### go to your github account and get `setting` page and click `Developer settings` in sidebar
#### and click `Personal access tokens` link and click  `Tokens (classic)`  and `generate new token` button
#### after enter a `note` and `Expiration time`
#### select all of `repo` checkbox and `delete_repo` checkbox in Select scopes
and click `Generate token`
## copy code and get http://localhost:8080/dashboard past code in Github Token input


#### now you can use this command
 #### for create a repository in github : 
         app:create-github-repo {username} {reponame}         
`reponame` parameter is your github repository name you want to create

`username` parameter is your github username

 #### for delete a repository in github : 
     app:delete-github-repo {username} {reponame}
`reponame` parameter is your github repository name you want to deleted

`username` parameter is your github username

### for see list all repositories created get this Endpoint:
    http://localhost:8080/repositories/

### for see list all repositories created with filter by username get this Endpoint:
    http://localhost:8080/repositories/username
### for example
    http://localhost:8080/repositories/soheyla-karimzade
    
    
for login with email and password 
enter you github email in `email` input
enter 123456 in `password` input

for bug fix update password form will be created
 
    

      
     


    

    
