class CrawlerWorker
  include Sidekiq::Worker
  sidekiq_options retry: false
  
  def perform
    Url.find_each(email) do |url|
      CrawlerController.include(url).find
    end
  end
end