class CreateEmails < ActiveRecord::Migration[5.1]
  def change
    create_table :emails do |t|
      t.string :email, null: false

      t.timestamps
    end
    
    add_index :emails, [:email], unique: true
  end
end
