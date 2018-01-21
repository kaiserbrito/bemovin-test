class Email < ApplicationRecord
  validates :email, presence: true, uniqueness: true
end
