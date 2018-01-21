require 'sidekiq/web'
Rails.application.routes.draw do  
  
  mount Sidekiq::Web => '/sidekiq'

  get 'crawler/index', :as => :crawler

  root 'crawler#index'
end
