Rails.application.routes.draw do  

  require 'sidekiq/web'
  
  mount Sidekiq::Web => '/sidekiq'

  root to: 'crawler#index'
    
  get 'crawler/search' => 'crawler#search', as: :crawler_url
  
end
