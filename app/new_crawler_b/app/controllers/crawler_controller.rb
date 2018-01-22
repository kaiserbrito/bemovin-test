require 'open-uri'

class CrawlerController < ApplicationController

  # Função de início que já pega 10 emails
  def index
    @emails = Email.take(10)
  end  
  
  # Função que busca urls na pagina, através do Nokogiri  
  def search
    urls = Url.all
    urls_to_add = []
    email_to_add = []

    urls.each do |i|
      pag = Nokogiri::HTML(open(i.url))
      tags = pag.css('a')

      tags.each do |t|
        urls_to_add.push(t["href"])
      end
    end
    
    CrawlerWorker.perform_async(urls_to_add)
    redirect_to root_path
  end
  
  #Função que na urls buscada, encontra emails, caso o email for repetido, ele não é inserido no BD.


end
