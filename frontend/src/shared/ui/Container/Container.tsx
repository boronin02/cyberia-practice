import styles from "./Container.module.scss";
import clsx from "clsx";

type ContainerProps = {
  children: React.ReactNode;
  className?: string;
};

export const Container = ({ children, className }: ContainerProps) => {
  return <div className={clsx(styles.container, className)}>{children}</div>;
};
