class app::codebase {

  info("Deploying Codebase for environment $environment")

  file { "/vagrant/html/.htaccess" :
     group => "www-data",
     owner => "root",
     mode => 775,
     source => "puppet:///modules/app/config/$::environment/public/.htaccess"
  }
 
}
