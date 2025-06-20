// #region [Imports] ===================================================================================================

// Libraries
import { Table, Pagination } from 'antd';

// Hooks
import useStoreCreditEntries from './useStoreCreditEntries';

// #endregion [Imports]

// #region [Variables] =================================================================================================

declare var acfwStoreCredits: any;

// #endregion [Variables]

// #region [Interfaces]=================================================================================================

interface IStoreCreditEntry {
  key: string;
  id: number;
  amount: string;
  type: string;
  activity: string;
  user_id: string;
  date: string;
  rel_link: string;
  rel_label: string;
  note: string;
}

// #endregion [Interfaces]

// #region [Component] =================================================================================================

const StoreCreditsHistory = () => {
  const { labels } = acfwStoreCredits;
  const { entries, loading, currentPage, total, setCurrentPage } = useStoreCreditEntries();

  const columns = [
    {
      title: labels.date,
      dataIndex: 'date',
      key: 'date',
    },
    {
      title: labels.activity,
      dataIndex: 'activity',
      key: 'activity',
    },
    {
      title: labels.amount,
      dataIndex: 'amount',
      key: 'amount',
    },
    {
      title: labels.related,
      dataIndex: 'rel_label',
      key: 'rel_label',
      render: (label: string, record: IStoreCreditEntry) => {
        if (!record.rel_link) return label;

        return (
          <a href={record.rel_link} target='_blank'>
            {label}
          </a>
        );
      },
    },
  ];

  const handlePaginationClick = (value: number) => {
    setCurrentPage(value);
    // loadEntries(value);
  };

  return (
    <div className='acfw-store-credit-history'>
      <Table loading={loading} columns={columns} dataSource={entries} pagination={false} />
      {0 < total && (
        <Pagination
          defaultCurrent={currentPage}
          current={currentPage}
          hideOnSinglePage={true}
          disabled={!entries || !entries.length}
          total={total}
          pageSize={10}
          showSizeChanger={false}
          onChange={handlePaginationClick}
        />
      )}
    </div>
  );
};

export default StoreCreditsHistory;

// #endregion [Component]
