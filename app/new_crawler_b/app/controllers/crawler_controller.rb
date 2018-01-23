require 'open-uri'

class CrawlerController < ApplicationController

  # Função de início que já pega 10 emails e todos os e-mails e url visitadas
  def index
    @emails = Email.take(10)
    @all = Email.all
    @visit = Url.all
  end  
  
  # Função que busca urls na pagina, através do Nokogiri  
  def get_emails
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

end
