class CrawlerWorker
  include Sidekiq::Worker
  sidekiq_options retry: false
  
  def perform(urls_crawled)
    urls_crawled.each do |c|
      if !c.nil?
        if c.include? "mailto:"
          url = Email.new
          email = c[7..c.length]
          url.email = email
          count = Email.where(:email => email).count
    
          if count == 1
            url.email = nil
          end
        else
          url = Email.new
          url.email = nil
        end
    
        if url.valid?
          url.save
        end
      end
    end
  end
end