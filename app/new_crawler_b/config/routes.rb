Rails.application.routes.draw do  

  require 'sidekiq/web'
  
  mount Sidekiq::Web => '/sidekiq'

  root to: 'crawler#index'
    
  get 'crawler/get_emails' => 'crawler#get_emails', as: :crawler_url
  
end
