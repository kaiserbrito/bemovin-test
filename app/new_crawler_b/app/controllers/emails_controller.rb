class EmailsController < ApplicationController
  def index
    @emails = Email.take(10)
  end
end
