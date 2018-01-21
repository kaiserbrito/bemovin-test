class CreateSettings < ActiveRecord::Migration[5.1]
  def change
    create_table :settings do |t|
      t.boolean :activated, default: false
      t.timestamps
    end
  end
end
