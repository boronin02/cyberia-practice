import styles from "./Projects.module.css";
import { ColumnLeft } from "./ColumnLeft";
import { ColumnRight } from "./ColumnRight";

export const Card = () => {
  return (
    <div className={styles.wrapper}>
      <ColumnLeft />
      <ColumnRight />
    </div>
  );
};
